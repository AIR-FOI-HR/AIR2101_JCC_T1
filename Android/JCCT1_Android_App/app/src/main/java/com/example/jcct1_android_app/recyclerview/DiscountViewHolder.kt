package com.example.jcct1_android_app.recyclerview

import android.view.View
import android.widget.TextView
import androidx.annotation.NonNull
import com.bignerdranch.expandablerecyclerview.ChildViewHolder
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.R

class DiscountViewHolder: ChildViewHolder<Museum> {
    var museumName: TextView? = null
    var museumDesc: TextView? = null
    var museumValue: TextView? = null

    constructor(@NonNull itemView: View): super(itemView){
        museumName = itemView.findViewById(R.id.museum_name)
        museumDesc = itemView.findViewById(R.id.museum_desc)
        museumValue = itemView.findViewById(R.id.museum_image)
    }

    public fun bindDataToView(discount: Museum){
        museumName?.text = discount.name
        museumDesc?.text = discount.layout
        museumValue?.text = (discount.mail).toString()
    }
}
