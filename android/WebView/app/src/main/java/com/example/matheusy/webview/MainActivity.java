package com.example.matheusy.webview;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageButton;

public class MainActivity extends AppCompatActivity {
    WebView wv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ImageButton tras = (ImageButton)findViewById(R.id.tras);
        ImageButton frente = (ImageButton)findViewById(R.id.frente);
        ImageButton home = (ImageButton)findViewById(R.id.home);
        ImageButton atualiza = (ImageButton)findViewById(R.id.atualizar);


        wv = (WebView) this.findViewById(R.id.wb2);
        wv.getSettings().setJavaScriptEnabled(true);
        wv.loadUrl("https://elaleph.com.br/hug-health/");

        wv.setWebViewClient(new WebViewClient() {
            @Override
            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                view.loadUrl(url);
                return false;
            }
        });

        tras.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                wv.goBack();
            }
        });
        frente.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                wv.goForward();
            }
        });

        home.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                wv.loadUrl("http://google.com");
            }
        });
        atualiza.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                wv.reload();
            }
        });
    }
}
