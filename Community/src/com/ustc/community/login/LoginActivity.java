package com.ustc.community.login;

import java.io.IOException;
import java.io.UnsupportedEncodingException;

import org.apache.http.client.ClientProtocolException;
import org.json.JSONException;
import org.json.JSONObject;

import com.ustc.community.R;


import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends Activity implements OnClickListener {
	
	private Handler handler;
	private EditText username;
	private EditText password;
	private Button btn_login;
	private Button btn_cancle;
	private String url = "http://192.168.3.106/community/clientlogin.php";
	
	private String nickname;
	private String pwd;
	private String key;
	
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_login);
		
		username = (EditText) findViewById(R.id.nickname);
		password = (EditText) findViewById(R.id.pwd);
		

		btn_login = (Button) findViewById(R.id.login);
		btn_cancle = (Button) findViewById(R.id.cancle);

		btn_login.setOnClickListener(this);
		btn_cancle.setOnClickListener(this);

		handler = new Handler(){//处理登陆返回的数据
			@Override
			public void handleMessage(Message msg) {
				// TODO Auto-generated method stub
				super.handleMessage(msg);
				switch (msg.what) {
				case 0://what=0--login
					try {
						String res = msg.getData().getString("res");
						JSONObject result = new JSONObject(res);
						//Toast.makeText(LoginActivity.this, res + ":\n" +result.toString(), Toast.LENGTH_LONG).show();
						int success = Integer.parseInt(result.getString("success"));//success：0-成功；1-失败
						if(success == 0){
							//保存用户名、密码。蓝牙密钥到本地
							SharedPreferences mySharedPreferences= getSharedPreferences("message", 
									Activity.MODE_PRIVATE); 
							SharedPreferences.Editor editor = mySharedPreferences.edit(); 
							key=result.getString("key");
							editor.putString("nickname", nickname); 
							editor.putString("pwd", pwd); 
							editor.putString("key",key );
							editor.commit(); 
							
							Intent intent = new Intent(LoginActivity.this, com.ustc.community.MainActivity.class);
							intent.putExtra(com.ustc.community.MainActivity.EXTRA_SAVED, true);
							startActivity(intent);
							Toast.makeText(LoginActivity.this, "登陆成功", Toast.LENGTH_LONG).show();
						}else{
							Toast.makeText(LoginActivity.this, "输入的用户名或密码有错", Toast.LENGTH_LONG).show();
						}
					} catch (JSONException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					break;

				default:
					break;
				}
			}
		};

		Bundle bundle = this.getIntent().getExtras();
	
	}

	public void onClick(View v){
		int id = v.getId();
		switch(id){
		//登陆按钮点击事件
		case R.id.login:
			new Thread(){
				@Override
				public void run() {
					// TODO Auto-generated method stub
					super.run();
					try {
						JSONObject json = new JSONObject();//传入服务器的json对象
						json.put("UserName", username.getText().toString().trim());
						json.put("PassWord", password.getText().toString().trim());
						//						httpPostMethod(json);
						nickname=username.getText().toString().trim();
						pwd=password.getText().toString().trim();
						HttpUtils.httpPostMethod(url, json, handler);
					} catch (JSONException e) {
						// TODO Auto-generated catch block
						Log.d("json", "解析JSON出错");
						e.printStackTrace();
					} catch (UnsupportedEncodingException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					} catch (ClientProtocolException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					} catch (IOException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
				}
			}.start();
			break;
		//注册按钮点击事件
		case R.id.cancle:
			Intent intent = new Intent(LoginActivity.this, com.ustc.community.MainActivity.class);
			startActivity(intent);
			break;
		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}
}
