package com.example.ws

import com.example.core.all.entities.entities.Artwork
import com.example.ws.handlers.MyWebserviceHandler
import com.example.ws.responses.MyWebserviceResponseMuseum
import com.squareup.okhttp.OkHttpClient
import com.example.core.all.entities.entities.Museum
import com.example.ws.responses.MyWebserviceResponseArtwork
import retrofit.*

class MyWebserviceCaller {
    var retrofit : Retrofit? = null
    val baseUrl : String = "http://192.168.1.43:5000/"

    constructor(){
        val client: OkHttpClient = OkHttpClient()

        retrofit = Retrofit.Builder()
            .baseUrl(baseUrl)
            .addConverterFactory(GsonConverterFactory.create())
            .client(client)
            .build()
    }

    fun getAllMuseums(method: String, dataArrivedHandler: MyWebserviceHandler)
    {
        val serviceCaller: MyWebservice? = retrofit?.create(MyWebservice::class.java)
        var call: Call<MyWebserviceResponseMuseum>? = null
        if (serviceCaller != null) {
            call = serviceCaller.getAllMuseumsCaller()
        }

        if(call != null){
            call.enqueue(object: Callback<MyWebserviceResponseMuseum> {


                override fun onResponse(
                    responseMuseum: Response<MyWebserviceResponseMuseum>?,
                    retrofit: Retrofit?
                ) {
                    try{
                        if (responseMuseum != null) {
                            if(responseMuseum.isSuccess()){
                                println("Got stores... Processing...")
                                val museumItems: Array<Museum>? = responseMuseum.body().items;

                              //  val gson : Gson = Gson()
                              //  val museumItems: Array<Museum>? = gson.fromJson(response.body().items, Array<Museum>::class.java)

                                if (museumItems != null) {
                                    //data obtained send it to handler
                                    //dataArrivedHandler.onDataArrived<Museum>(museumItems.toList(), true, response.body().timeStamp)
                                    dataArrivedHandler.onDataArrived<Museum>(museumItems.toList(), true)
                                }
                            }
                        }
                    }catch (ex: Exception){
                        ex.printStackTrace()
                    }
                }

                override fun onFailure(t: Throwable?) {
                    t?.printStackTrace()
                }
            })
        }
    }


    fun getAllArtworks(method: String, dataArrivedHandler: MyWebserviceHandler)
    {
        val serviceCaller: MyWebservice? = retrofit?.create(MyWebservice::class.java)
        var call: Call<MyWebserviceResponseArtwork>? = null
        if (serviceCaller != null) {
            call = serviceCaller.getAllArtworksCaller()
        }

        if(call != null){
            call.enqueue(object: Callback<MyWebserviceResponseArtwork> {


                override fun onResponse(
                    responseArtwork: Response<MyWebserviceResponseArtwork>?,
                    retrofit: Retrofit?
                ) {
                    try{
                        if (responseArtwork != null) {
                            if(responseArtwork.isSuccess()){
                                println("Got stores... Processing...")
                                val artworkItems: Array<Artwork>? = responseArtwork.body().items;

                                //  val gson : Gson = Gson()
                                //  val museumItems: Array<Museum>? = gson.fromJson(response.body().items, Array<Museum>::class.java)

                                if (artworkItems != null) {
                                    //data obtained send it to handler
                                    //dataArrivedHandler.onDataArrived<Museum>(museumItems.toList(), true, response.body().timeStamp)
                                    dataArrivedHandler.onDataArrived<Artwork>(artworkItems.toList(), true)
                                }
                            }
                        }
                    }catch (ex: Exception){
                        ex.printStackTrace()
                    }
                }

                override fun onFailure(t: Throwable?) {
                    t?.printStackTrace()
                }
            })
        }
    }
}