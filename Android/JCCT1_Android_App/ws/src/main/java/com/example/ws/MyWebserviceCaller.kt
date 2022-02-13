package com.example.ws

import com.example.ws.responses.MyWebserviceResponse
import com.squareup.okhttp.OkHttpClient
import retrofit.Call
import retrofit.GsonConverterFactory
import retrofit.Retrofit

class MyWebserviceCaller {
    var retrofit : Retrofit? = null
    val baseUrl : String = "http://localhost/phpmyadmin/index.php?route=/table/structure&db=jcc_baza&table=museum"

    constructor(){
        val client: OkHttpClient = OkHttpClient()

        retrofit = Retrofit.Builder()
            .baseUrl(baseUrl)
            .addConverterFactory(GsonConverterFactory.create())
            .client(client)
            .build()
    }

    fun getAllMuseums(method: String){
        val serviceCaller: MyWebservice? = retrofit?.create(MyWebservice::class.java)
        var call: Call<MyWebserviceResponse>? = null
        if(serviceCaller != null) {
            call = serviceCaller.getAllMuseumsCaller(method)
        }

        call?.enqueue()
    }
}