package com.ustc.community;


import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.UUID;

import com.tuner168.ble.BleCallBack;
import com.tuner168.ble.BleService;
import com.ustc.community.ble.Action;
import com.ustc.community.ble.ConnectedLeDevice;
import com.ustc.community.ble.DataUtil;
import com.ustc.community.ble.ToastUtil;
import com.ustc.community.ble.Uuids;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.AlertDialog;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.bluetooth.BluetoothGatt;
import android.bluetooth.BluetoothGattCharacteristic;
import android.bluetooth.BluetoothManager;
import android.content.BroadcastReceiver;
import android.content.ComponentName;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.ServiceConnection;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.IBinder;
import android.support.v4.content.LocalBroadcastManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;


public class MainActivity extends Activity {
	private TextView text_nickname;
    private Button btn_open;
    private Button btn_service;
    private Button btn_message;
    LinearLayout linearLayout;
    
    private ArrayList<String> deviceAddressList;
    private String myBluetoothDeviceAddress;
    private String myBluetoothName;
    private ListView lv;
	private TextView textViewValues, tv_hint;
	private ProgressBar pbar;
	ConnectedLeDevice connectedDevice;
	
	public static BleService mLeService;
	private BluetoothAdapter mBluetoothAdapter;
	public static final String EXTRA_DEVIE_MAC = "extra_devie_mac";
	public static final String EXTRA_DEVIE_NAME = "extra_devie_name";
	public static final String EXTRA_DATA = "extra_data";
	private static final int REQUEST_ENABLE_BT = 1;
	public static boolean gattFlag=false;
	//private boolean mScanning;
	private Handler mHandler;

	// Stops scanning after 10 seconds.
	private static final long SCAN_PERIOD = 3000;
    
    private String key;//
    public static final String EXTRA_SAVED="com.ustc.community.login.saved";

    
    private final BleCallBack mBleCallBack = new BleCallBack() {

		@Override
		public void onConnected(String mac) {//连接成功
			Log.i("connect", "onConnected() - " + mac);		
			ToastUtil.showMsg(MainActivity.this, R.string.scan_connected, mac + " ");
			//mLeService.startReadRssi(mac, 1000);
		}

		@Override
		public void onConnectTimeout(String mac) {//连接超时
			Log.w("connect", "onConnectFailed() - " + mac);
			ToastUtil.showMsg(MainActivity.this, R.string.scan_connect_failed, mac + " ");
		}

		@Override
		public void onDisconnected(String mac) {//连接断开
			Log.w("connect", "onDisconnected() - " + mac);
			ToastUtil.showMsg(MainActivity.this, R.string.scan_disconnected, mac + " ");
			broadcastUpdate(Action.ACTION_GATT_DISCONNECTED, mac);
		}

		@Override
		public void onServicesDiscovered(String mac) {//获取GATT句柄成功
			Log.i("gatt", "onServicesDiscovered() - " + mac);
			gattFlag=true;
			sendHand thread1=new sendHand();
			thread1.start();
		}

		@Override
		public void onServicesUndiscovered(String mac, int status) {//获取GATT句柄失败
			Log.w("gatt", "onServicesUndiscovered() - " + mac + ", status = " + status);
		}

		@Override
		public void onCharacteristicChanged(String mac, byte[] data) {// 默认uuid数据0x1001
			Log.i("change", "onCharacteristicChanged() - " + mac + " " + com.tuner168.api.DataUtil.byteArrayToHex(data));
			Intent arg0 = new Intent(Action.ACTION_NOTIFY_DATA);
			arg0.putExtra(EXTRA_DEVIE_MAC, mac);
			arg0.putExtra(EXTRA_DATA, data);
			LocalBroadcastManager.getInstance(MainActivity.this).sendBroadcast(arg0);
		}

		@Override
		public void onCharacteristicChanged(String mac, BluetoothGattCharacteristic characteristic) {//其他uuid的数据
			UUID charUuid = characteristic.getUuid();
			byte[] data = characteristic.getValue();
			Intent arg0 = new Intent(Action.ACTION_NOTIFY_DATA);
			arg0.putExtra(EXTRA_DEVIE_MAC, mac);
			arg0.putExtra(EXTRA_DATA, data);
			LocalBroadcastManager.getInstance(MainActivity.this).sendBroadcast(arg0);
			Log.i("change", "onCharacteristicChanged() - mac " + mac + ", charUuid " + charUuid.toString() + com.tuner168.api.DataUtil.byteArrayToHex(data));
		}

		/**
		 * 方法已过时
		 */
		@Override
		public void onCharacteristicRead(String mac, byte[] data, int status) {
		}

		@Override
		public void onCharacteristicRead(String mac, BluetoothGattCharacteristic characteristic, int status) {
			if (status == BluetoothGatt.GATT_SUCCESS) {
				if (characteristic.getUuid().equals(Uuids.CHARACTER_DEVICE_NAME)) {
					byte[] value = characteristic.getValue();
					String name = "";
					try {
						name = new String(value, "ascii");
					} catch (UnsupportedEncodingException e) {
						e.printStackTrace();
					}

					Intent nameIntent = new Intent(Action.ACTION_READ_DATA_DEVICE_NAME);
					nameIntent.putExtra(EXTRA_DEVIE_MAC, mac);
					nameIntent.putExtra(BluetoothDevice.EXTRA_NAME, new String(characteristic.getValue()).trim());
					LocalBroadcastManager.getInstance(MainActivity.this).sendBroadcast(nameIntent);
					Log.i("change", "onCharacteristicRead() - mac " + mac + ", uuid: " + characteristic.getUuid().toString() + ", name:" + name
							+ ", value.length = " + value.length);
				}
			}
		}
/*
		@Override
		public void onRegRead(String mac, String regData, int regFlag, int status) {
			// 模组参数的读取都在该回调函数获得
			if (status == BluetoothGatt.GATT_SUCCESS) {
				Intent arg0 = new Intent("ACTION_READ_DATA");
				arg0.putExtra(EXTRA_DEVIE_MAC, mac);
				arg0.putExtra(EXTRA_DATA, regData);
				//arg0.putExtra(EXTRA_REG_FLAG, regFlag);
				LocalBroadcastManager.getInstance(MainActivity.this).sendBroadcast(arg0);
				Log.i("reg", mac + " - data:" + regData);
			}
		}

		@Override
		public void onReadRemoteRssi(String mac, int rssi, int status) {
			 Log.i("rssi", mac + " - rssi = " + rssi);
			Intent arg0 = new Intent("ACTION_UPDATE_RSSI");
			arg0.putExtra(EXTRA_DEVIE_MAC, mac);
			//arg0.putExtra(EXTRA_RSSI, rssi);
			LocalBroadcastManager.getInstance(MainActivity.this).sendBroadcast(arg0);
		}
		*/
	};

	private void broadcastUpdate(String action, String mac) {
		Intent arg0 = new Intent(action);
		arg0.putExtra(EXTRA_DEVIE_MAC, mac);
		LocalBroadcastManager.getInstance(MainActivity.this).sendBroadcast(arg0);
	}

	private IntentFilter makeFilter() {
		IntentFilter filter = new IntentFilter();
		filter.addAction(Action.ACTION_GATT_DISCONNECTED);
		filter.addAction(Action.ACTION_UPDATE_RSSI);
		filter.addAction(Action.ACTION_NOTIFY_DATA);
		return filter;
	}

	// 注册本地广播
	private void regBroadcast() {
		LocalBroadcastManager.getInstance(MainActivity.this).registerReceiver(mGattReceiver, makeFilter());
	}

	// 注销本地广播
	private void unregBroadcast() {
		LocalBroadcastManager.getInstance(MainActivity.this).unregisterReceiver(mGattReceiver);
	}
	private final BroadcastReceiver mGattReceiver = new BroadcastReceiver() {

		@Override
		public void onReceive(Context context, Intent intent) {
			// 此处接收的广播由 MainActivity中的 mBleCallBack处发出

			if (Action.ACTION_NOTIFY_DATA.equals(intent.getAction())) {
				// 收到notify数据
				System.out.println("broad_data");
				byte[] data = intent.getByteArrayExtra(EXTRA_DATA);
				String rxData = com.tuner168.api.DataUtil.byteArrayToHex(data);
				BluetoothGatt gatt = mLeService
						.getBluetoothGatt(EXTRA_DEVIE_MAC);
				
				if (connectedDevice != null) {
					connectedDevice.setRxData(rxData);
					//mBluetoothAdapter.notify();
					Log.i("connectedDevice",connectedDevice.getRxData());
				}
				Log.i("boardcast","收到notify数据");

			} else if (Action.ACTION_GATT_DISCONNECTED.equals(intent.getAction())) {
				// 断线
				connectedDevice=null;
			}
		}
	};
    
    private final ServiceConnection conn = new ServiceConnection() {

		@Override
		public void onServiceDisconnected(ComponentName name) {
			mLeService = null;
		}

		@Override
		public void onServiceConnected(ComponentName name, IBinder service) {
			mLeService = ((BleService.LocalBinder) service).getService(mBleCallBack);
			// mLeService.setMaxConnectedNumber(max);// 设置最大可连接从机数量，默认为4
			// 必须调用初始化函数
			mLeService.initialize();
			//mLeService.setDecode(true);
		}
	};
    
	// Device scan callback.
	@SuppressLint("NewApi") private BluetoothAdapter.LeScanCallback mLeScanCallback = new BluetoothAdapter.LeScanCallback() {

		@Override
		public void onLeScan(final BluetoothDevice device, int rssi,
				byte[] scanRecord) {
			runOnUiThread(new Runnable() {
				@Override
				public void run() {
					if(deviceAddressList.size()==0)
						deviceAddressList.add(device.getName()+":"+device.getAddress());
					for (int i=0;i<deviceAddressList.size();i++) {
						if(!deviceAddressList.get(i).equals(device.getName()+":"+device.getAddress()))
							deviceAddressList.add(device.getName()+":"+device.getAddress());
					}
					
					//deviceAddressList.add(device.getAddress());
					//mLeDeviceListAdapter.notifyDataSetChanged();
				}
			});
		}
	};
	
	@SuppressLint("NewApi") private void scanLeDevice(final boolean enable) {
		if (enable) {
			if(mBluetoothAdapter.isEnabled()){
				//deviceAddressList.clear();
				// Stops scanning after a pre-defined scan period.
				mHandler.postDelayed(mScanRunnable, SCAN_PERIOD);
				mBluetoothAdapter.startLeScan(mLeScanCallback);
				//mScanBtn.setChecked(true);
				//pbar.setVisibility(View.VISIBLE);
			}else {
				//ToastUtil.showMsg(getActivity(), R.string.scan_bt_disabled);
				//mScanBtn.setChecked(false);
			}
		} else {
			mBluetoothAdapter.stopLeScan(mLeScanCallback);
			//mScanBtn.setChecked(false);
			mHandler.removeCallbacks(mScanRunnable);
			//pbar.setVisibility(View.GONE);
		}
	}
	

	private final Runnable mScanRunnable = new Runnable() {

		@Override
		public void run() {
			//mScanBtn.setChecked(false);
			setView();
			pbar.setVisibility(View.GONE);
		}
	};
    
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);//隐藏标题栏
        setContentView(R.layout.activity_main);
        //蓝牙
        mHandler = new Handler();
        final BluetoothManager bluetoothManager = (BluetoothManager) getSystemService(Context.BLUETOOTH_SERVICE);
		mBluetoothAdapter = bluetoothManager.getAdapter();

		if (mBluetoothAdapter == null) {
			Toast.makeText(this, R.string.error_bluetooth_not_supported, Toast.LENGTH_SHORT).show();
			finish();
			return;
		}
		bindService(new Intent(this, BleService.class), conn, BIND_AUTO_CREATE);
        
		deviceAddressList = new ArrayList<String>();
        //功能按键
        btn_open = (Button) findViewById(R.id.button_open);
        btn_message=(Button) findViewById(R.id.button_message);
        btn_service=(Button) findViewById(R.id.button_service);
        linearLayout = (LinearLayout) findViewById(R.id.ly_login);
        text_nickname=(TextView)findViewById(R.id.loginname);
        
        boolean flag=getIntent().getBooleanExtra(EXTRA_SAVED, false);
        if(flag){
        	SharedPreferences sharedPreferences= getSharedPreferences("message", 
        		Activity.MODE_PRIVATE); 
        		if(sharedPreferences!=null){
        			text_nickname.setText(sharedPreferences.getString("nickname",""));
        			key=sharedPreferences.getString("key","");
        		}
        }
        
        btn_open.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
            	Toast.makeText(getApplicationContext(), "查找蓝牙设备",
    					Toast.LENGTH_SHORT).show();
            	scanLeDevice(true);
    			actionAlertDialog();
            }
        });
        
        btn_message.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
			}
		});
        
        btn_service.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
			}
		});
        
        linearLayout.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {//跳转到注册/登陆页面
                        Intent intent=new Intent(MainActivity.this,com.ustc.community.login.LoginActivity.class);
                        startActivity(intent);
                    }
                }
        );

    }

    @Override
	protected void onResume() {
		super.onResume();
		if (!mBluetoothAdapter.isEnabled()) {
			if (!mBluetoothAdapter.isEnabled()) {
				Intent enableBtIntent = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
				startActivityForResult(enableBtIntent, REQUEST_ENABLE_BT);//启动蓝牙提示框
			}
		}
		if (mLeService != null) {
			mLeService.setDecode(true);//数据是否加密
		}
		regBroadcast();
	}
    
	@Override
	public void onStop() {
		super.onStop();
		unregBroadcast();
	}
	
    @Override
	protected void onDestroy() {
		super.onDestroy();
		unbindService(conn);
	}
    
    @Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		// User chose not to enable Bluetooth.
		if (requestCode == REQUEST_ENABLE_BT && resultCode == Activity.RESULT_CANCELED) {
			finish();
			return;
		}
		super.onActivityResult(requestCode, resultCode, data);
	}
    
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }
    
   
    private void actionAlertDialog() {
		AlertDialog.Builder builder;
		final AlertDialog alertDialog;
		View view = getLayoutInflater().inflate(R.layout.device_list, null);

		lv= (ListView) view.findViewById(R.id.device_list);
		tv_hint = (TextView) view.findViewById(R.id.tv);
		pbar = (ProgressBar) view.findViewById(R.id.pbar);

		// 创建对话框
		builder = new AlertDialog.Builder(MainActivity.this);
		builder.setView(view);
		builder.setPositiveButton("重试",
				new DialogInterface.OnClickListener() {
					// 重试按钮
					@Override
					public void onClick(DialogInterface dialog, int which) {
						// TODO Auto-generated method stub
						//reScanLeDevice(true);
						scanLeDevice(true);
						actionAlertDialog();;
					}
				});
		builder.setNegativeButton("取消",
				new DialogInterface.OnClickListener() {

					@Override
					public void onClick(DialogInterface dialog, int which) {
						System.out.println("取消查找");
						dialog.dismiss();
					}
				});
		alertDialog = builder.create();
		alertDialog.show();

		lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				// TODO Auto-generated method stub
				TextView tv = (TextView) view;
				// Toast.makeText(MainActivity.this, "地址：" + tv.getText(),
				// Toast.LENGTH_SHORT).show();
				String[] namemac=tv.getText().toString().trim().split(":",2); 
				myBluetoothName=namemac[0];
				myBluetoothDeviceAddress = namemac[1];
				Log.i("mac",myBluetoothDeviceAddress);
				System.out.println(myBluetoothDeviceAddress);
				alertDialog.cancel();
				// 通知服务去连接
				Log.i("mleservice","connect");
				mLeService.connect(myBluetoothDeviceAddress,true);
				connectedDevice=new ConnectedLeDevice(myBluetoothName, myBluetoothDeviceAddress);
				
			}
		});
    }
    class sendHand extends Thread{
    	@Override
    	public void run(){
    		while(true){
			//发送握手信号
				String hexHand="f10304e324a869";
				Boolean handFlog=mLeService.send(myBluetoothDeviceAddress, hexHand, true);
				Log.i("hand",handFlog.toString());
				try {
					Thread.sleep(1000);
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				if(handFlog){
					checkKey thread2=new checkKey();
					thread2.start();
					break;
				}
				
			}
    	}
    }
    class checkKey extends Thread{
    	@Override
    	public void run(){
			while(true){
				//验证密码
				String hexKey="f10203666666";
				Boolean verifyFlog=mLeService.send(myBluetoothDeviceAddress, hexKey, true);
				Log.i("verify",verifyFlog.toString());
				try {
					Thread.sleep(1000);
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				if(verifyFlog){
					Log.i("验证密码成功",connectedDevice.getRxData());
					//changeKey thread3=new changeKey();
					//thread3.start();
					break;
				}
			}
    	}
    }
    
    class changeKey extends Thread{
    	@Override
    	public void run(){
    		while(true){
				//修改密码
				String hexNewKey="f10103888888";
				Boolean changeFlog=mLeService.send(myBluetoothDeviceAddress, hexNewKey, true);
				Log.i("changekey",changeFlog.toString());
				try {
					Thread.sleep(1000);
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				if(changeFlog){
					Log.i("修改密码成功",connectedDevice.getRxData());
					break;
				}
			}
    	}
    }
    public void setView() {
		if (deviceAddressList.size() > 0) {
			lv.setVisibility(View.VISIBLE);
			tv_hint.setVisibility(View.GONE);
			pbar.setVisibility(View.GONE);
			ArrayAdapter<String> adapter = new ArrayAdapter<String>(
					MainActivity.this,
					android.R.layout.simple_list_item_single_choice,
					deviceAddressList);
			lv.setChoiceMode(ListView.CHOICE_MODE_SINGLE);
			lv.setAdapter(adapter);

		} else if (deviceAddressList.size() == 0) {
			lv.setVisibility(View.GONE);
			tv_hint.setVisibility(View.VISIBLE);
			tv_hint.setText("device not found!");
			pbar.setVisibility(View.GONE);
		}

	}
}
