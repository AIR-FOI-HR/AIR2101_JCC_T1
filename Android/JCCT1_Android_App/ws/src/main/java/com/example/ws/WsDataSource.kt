package com.example.ws

import android.content.Context
import com.example.core.all.entities.data.DataSource
import com.example.core.all.entities.data.DataSourceListener
import com.example.core.all.entities.entities.Museum
import com.example.ws.handlers.MyWebserviceHandler


class WsDataSource : DataSource {
    private var listener: DataSourceListener? = null
    private var museums: List<Museum>? = null

    private var museumsArrived: Boolean = false

    override fun loadData(dataSourceListener: DataSourceListener, context: Context) {

        this.listener = dataSourceListener

        val museumCaller: MyWebserviceCaller = MyWebserviceCaller()

        museumCaller.getAllStores("getAll", storeHandler)
    }

    @Suppress("UNCHECKED_CAST")
    private val storeHandler: MyWebserviceHandler = object : MyWebserviceHandler{
        override fun <T> onDataArrived(result: List<T>, ok: Boolean, timeStamp: Long?) {
            if(ok){
                museums = result as List<Museum>
            }
            museumsArrived = true
            checkDataArrival()
        }

    }

    private fun checkDataArrival(){
        if(museumsArrived){
            listener?.onDataLoaded(museums)
        }

}