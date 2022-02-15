package com.example.jcct1_android_app.recyclerview

import android.view.View
import android.widget.TextView
import androidx.annotation.NonNull
import com.bignerdranch.expandablerecyclerview.ChildViewHolder
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.R

class DiscountViewHolder: ChildViewHolder<Museum> {
    var museumDesc: TextView? = null

    constructor(@NonNull itemView: View): super(itemView){
        museumDesc = itemView.findViewById(R.id.museum_desc)

    }

    public fun bindDataToView(discount: Museum){
        museumDesc?.text = discount.Layout
    }
}
