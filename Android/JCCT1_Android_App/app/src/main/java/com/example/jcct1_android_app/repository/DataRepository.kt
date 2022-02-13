package com.example.jcct1_android_app.repository

import android.content.Context
import com.example.core.all.entities.Museum

class DataRepository {
    fun loadData(context : Context, listener : LoadDataListener)
    {
        //check if device is online
        //var internetCheck = InternetCheck()
        //var isOnline = internetCheck.isOnline(context)

        //use proper module to obtain data
        var dataSource : DataSource = WsDataSource()
       // if (isOnline)
         //   dataSource = WsDataSource()
       // else
         //   dataSource = DbDataSource()

        dataSource.loadData(
            object : DataSourceListener {
                override fun onDataLoaded(museums: List<Museum>?) {
                    listener.onDataLoaded(museums)

                    //TODO
                    //provjeriti izvor i po potrebi napravit cache podataka
                }
            },
            context
        )
    }
}