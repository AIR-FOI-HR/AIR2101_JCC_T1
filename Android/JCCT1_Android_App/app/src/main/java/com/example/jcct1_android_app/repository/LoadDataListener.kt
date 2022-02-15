package com.example.jcct1_android_app.repository

import com.example.core.all.entities.entities.Museum

interface LoadDataListener {
    fun onDataLoaded(museums: List<Museum>?)
}
