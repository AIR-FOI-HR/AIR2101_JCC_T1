package com.example.core.all.entities.data
import android.content.Context

interface DataSource {
    fun loadData(dataSourceListener: com.example.core.all.entities.data.DataSourceListener, context: Context)
}