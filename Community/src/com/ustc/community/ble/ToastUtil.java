package com.ustc.community.ble;

import android.app.Activity;
import android.content.Context;
import android.widget.Toast;

public class ToastUtil {
	public static void showMsg(final Context context, final int resId) {
		if(context instanceof Activity){
			((Activity) context).runOnUiThread(new Runnable() {
				@Override
				public void run() {
					Toast.makeText(context, context.getString(resId), Toast.LENGTH_SHORT)
					.show();
				}
			});
		}
	}

	public static void showMsg(final Context context, final int resId, final String msg) {
		if(context instanceof Activity){
			((Activity) context).runOnUiThread(new Runnable() {
				
				@Override
				public void run() {
					Toast.makeText(context, msg + context.getString(resId),
							Toast.LENGTH_SHORT).show();
				}
			});
		}
	}
}
