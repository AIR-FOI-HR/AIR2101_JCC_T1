package com.example.ws.handlers

import com.example.core.all.entities.entities.Museum

interface MyWebserviceHandler {
    fun <T>onDataArrived(result: List<T>, ok: Boolean)
    //fun onDataArrived(result: Objects, ok: Boolean, timestamp: Long?)
}