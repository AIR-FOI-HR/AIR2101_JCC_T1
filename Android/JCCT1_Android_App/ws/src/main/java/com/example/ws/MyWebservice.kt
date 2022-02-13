package com.example.ws

import android.telecom.Call
import com.example.ws.responses.MyWebserviceResponse
import retrofit.http.Field
import retrofit.http.FormUrlEncoded
import retrofit.http.GET
import retrofit.http.POST

interface MyWebservice {


    @GET("museums")
    fun getAllMuseumsCaller(@Field("method") method: String) : retrofit.Call<MyWebserviceResponse>

}