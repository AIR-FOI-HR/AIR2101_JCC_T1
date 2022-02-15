package com.example.ws

import android.telecom.Call
import com.example.ws.responses.MyWebserviceResponse
import retrofit.http.Field
import retrofit.http.FormUrlEncoded
import retrofit.http.GET
import retrofit.http.POST

interface MyWebservice {


    @GET("museum")
    fun getAllMuseumsCaller() : retrofit.Call<MyWebserviceResponse>

}