package com.jurtz.marcel.dartfails;

import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.LinearLayout;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    private WebView webViewMain;
    private LinearLayout layout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        getSupportActionBar().hide();

        final String loadUrl = "http://192.168.2.136/dart";

        webViewMain = (WebView) findViewById(R.id.webviewMain);
        webViewMain.setWebChromeClient(new WebChromeClient());

        layout = (LinearLayout) findViewById(R.id.linearLayoutMain);

        webViewMain.setWebViewClient(new WebViewClient() {
            public void onReceivedError(WebView view, int errorCode, String description, String failingUrl) {
                // File also under 'Assets'
                view.loadDataWithBaseURL("<!DOCTYPE html>",
                        "<html>\n" +
                                "\t<head>\n" +
                                "\t\t<title>No Connection</title>\n" +
                                "\t\t<meta charset=\"utf-8\">\n" +
                                "\t</head>\n" +
                                "\t<body>\n" +
                                "\t\t<div style=\"margin-top: 20%\">\n" +
                                "\t\t\t<div style=\"display:block; width: 80%; margin: 0 auto\">\n" +
                                "\t\t\t\t<p style=\"text-align: center; font-size: 72pt; font-family: Arial\">¯\\_(ツ)_/¯</p>\n" +
                                "\t\t\t\t<p style=\"text-align: center; font-size: 52pt; font-family: Arial\">No Connection!</p>\n" +
                                "\t\t\t</div>\n" +
                                "\t\t</div>\n" +
                                "\t</body>\n" +
                                "</html>", "text/html", "UTF-8", null);

            }
        });
        webViewMain.getSettings().setLoadWithOverviewMode(true);
        webViewMain.getSettings().setJavaScriptEnabled(true);
        webViewMain.getSettings().setUseWideViewPort(true);

        loadPage(webViewMain, loadUrl);
    }

    private void loadPage(WebView webViewMain, String loadUrl) {
        try {
            webViewMain.loadUrl(loadUrl);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    // Load Website all 5 Seconds
    /*
    public void reload(final WebView webViewMain, final String loadUrl) {
        final Handler handler = new Handler();
        handler.postDelayed(new Runnable() {
            @Override
            public void run() {
                // Do something after 5s = 5000ms
                Toast.makeText(getApplicationContext(), "Hello", Toast.LENGTH_SHORT).show();
                reload(webViewMain, loadUrl);
                loadPage(webViewMain, loadUrl);
            }
        }, 5000);
    }
    */
}
