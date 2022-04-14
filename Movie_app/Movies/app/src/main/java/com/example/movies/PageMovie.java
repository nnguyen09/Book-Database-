package com.example.movies;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class PageMovie extends AppCompatActivity {

    Button submitQuery;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_page_movie);

        submitQuery = findViewById(R.id.submitQuery2);

        TextView tvMovieTitle =  findViewById(R.id.tvMovieTitle);
        TextView tvLength = (TextView) findViewById(R.id.tvLength);


        Intent intent = getIntent();
        final String movieTitle = intent.getStringExtra("genre");
        final String password = intent.getStringExtra("title");


        String title = "Hello Email:  " + movieTitle;
        tvMovieTitle.setText(title);
        tvLength.setText("Password: "+ password);
        submitQuery.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            Log.d("SubmitQueryHelp", response);
                            JSONObject jsonResponse2 = new JSONObject(response);
                            boolean success = jsonResponse2.getBoolean("success");

                            if(success){
                                AlertDialog.Builder builder = new AlertDialog.Builder(PageMovie.this);
                                builder.setMessage("Failed").setNegativeButton("Retry", null).create().show();


                            } else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(PageMovie.this);
                                builder.setMessage("Failed").setNegativeButton("Retry", null).create().show();
                            }
                        } catch (JSONException e) {
                            AlertDialog.Builder builder = new AlertDialog.Builder(PageMovie.this);
                            builder.setMessage("Sign In Failed").setNegativeButton("Retry", null).create().show();
                        }
                    }
                };


                QueryRequest queryRequest = new QueryRequest(getString(R.string.url) + "/BookDatabase/task2_hist.php", responseListener);
                RequestQueue queue = Volley.newRequestQueue(PageMovie.this);
                queue.add(queryRequest);

            }
        });
        }
}
