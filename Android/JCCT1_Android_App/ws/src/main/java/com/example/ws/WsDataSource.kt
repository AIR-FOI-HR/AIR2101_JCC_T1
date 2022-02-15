package com.example.ws

import com.example.core.all.entities.data.DataSource
import com.example.core.all.entities.data.DataSourceListener
import com.example.core.all.entities.entities.Museum
import com.example.ws.handlers.MyWebserviceHandler


class WsDataSource : DataSource {
    private var listener: DataSourceListener? = null
    private var museums: List<Museum>? = null

    private var museumsArrived: Boolean = false

    override fun loadData(dataSourceListener: DataSourceListener) {

        this.listener = dataSourceListener

        val museumCaller: MyWebserviceCaller = MyWebserviceCaller()

        museumCaller.getAllMuseums("getAll", museumHandler)
    }

    @Suppress("UNCHECKED_CAST")
    private val museumHandler: MyWebserviceHandler = object : MyWebserviceHandler{
          override fun <T> onDataArrived(result: List<T>, ok: Boolean) {
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
}