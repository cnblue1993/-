package com.ustc.community.ble;

public class ConnectedLeDevice {
	private String name;
	private String mac;
	private String rxData = "No data";
	public int rssi;
	public ConnectedLeDevice(String name, String mac) {
		this.name = name;
		this.mac = mac;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getMac() {
		return mac;
	}
	public void setMac(String mac) {
		this.mac = mac;
	}
	public String getRxData() {
		return rxData;
	}
	public void setRxData(String rxData) {
		this.rxData = rxData;
	}
	@Override
	public boolean equals(Object o) {
		if(o instanceof ConnectedLeDevice){
			return ((ConnectedLeDevice) o).getMac().equals(mac);
		}
		return false;
	}
}
