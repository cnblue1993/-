package com.ustc.community.ble;

import java.util.UUID;

public class Uuids {
	/**
	 * <a href=
	 * 'https://developer.bluetooth.org/gatt/services/Pages/ServicesHome.aspx'</a
	 * > �� SIG ��service uuid�淶
	 */
	public static final UUID SERVICE_GENERIC_ACCESS = UUID
			.fromString("00001800-0000-1000-8000-00805f9b34fb");
	public static final UUID SERVICE_BLE=UUID.fromString("00001000-0000-1000-8000-00805f9b34fb");
	/**
	 * <a href=
	 * 'https://developer.bluetooth.org/gatt/characteristics/Pages/CharacteristicsHome.aspx'</a
	 * > �� SIG ��characteristic uuid�淶
	 */
	public static final UUID CHARACTER_DEVICE_NAME = UUID
			.fromString("00002a00-0000-1000-8000-00805f9b34fb");
	

}
