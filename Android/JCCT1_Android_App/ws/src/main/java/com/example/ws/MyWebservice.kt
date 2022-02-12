package com.example.ws

import retrofit.http.Field
import retrofit.http.FormUrlEncoded
import retrofit.http.POST

class MyWebservice {
    @FormUrlEncoded
    @POST("museums.php")
    fun getAllMuseumsCaller(@Field(method) method: String) : Call<MyWebserviceResponse>
}