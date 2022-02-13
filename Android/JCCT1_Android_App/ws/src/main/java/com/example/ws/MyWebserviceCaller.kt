package com.example.ws

import com.example.ws.handlers.MyWebserviceHandler
import com.example.ws.responses.MyWebserviceResponse
import com.google.gson.Gson
import com.squareup.okhttp.OkHttpClient
import com.example.core.all.entities.entities.Museum
import retrofit.*

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

    fun getAllStores(method: String, dataArrivedHandler: MyWebserviceHandler)
    {
        val serviceCaller: MyWebservice? = retrofit?.create(MyWebservice::class.java)
        var call: Call<MyWebserviceResponse>? = null
        if (serviceCaller != null) {
            call = serviceCaller.getAllMuseumsCaller(method)
        }

        if(call != null){
            call.enqueue(object: Callback<MyWebserviceResponse> {
                override fun onFailure(t: Throwable?) {
                    t?.printStackTrace()
                }

                override fun onResponse(
                    response: Response<MyWebserviceResponse>?,
                    retrofit: Retrofit?
                ) {
                    try{
                        if (response != null) {
                            if(response.isSuccess()){
                                println("Got stores... Processing...")
                                val gson : Gson = Gson()
                                val storeItems: Array<Museum>? = gson.fromJson(response.body().name, Array<Museum>::class.java)

                                if (storeItems != null) {
                                    //data obtained stend it to handler
                                    dataArrivedHandler.onDataArrived<Museum>(storeItems.toList(), true)
                                }
                            }
                        }
                    }catch (ex: Exception){
                        ex.printStackTrace()
                    }
                }
            })
        }
    }
}