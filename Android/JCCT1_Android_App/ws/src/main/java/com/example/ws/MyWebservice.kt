package com.example.ws

import com.example.ws.responses.MyWebserviceResponseMuseum
import retrofit.http.GET

interface MyWebservice {


    @GET("museum")
    fun getAllMuseumsCaller() : retrofit.Call<MyWebserviceResponseMuseum>

}