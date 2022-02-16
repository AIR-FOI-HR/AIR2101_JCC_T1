package com.example.jcct1_android_app.recyclerview

import android.view.View
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.annotation.NonNull
import androidx.navigation.NavController
import androidx.navigation.Navigation.findNavController
import com.bignerdranch.expandablerecyclerview.ChildViewHolder
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.R
import com.example.jcct1_android_app.ui.slideshow.SlideshowFragment

class DiscountViewHolder: ChildViewHolder<Museum> {
    var museumDesc: TextView? = null
    var moreInfoButton: Button? = null

    constructor(@NonNull itemView: View): super(itemView){
        museumDesc = itemView.findViewById(R.id.museum_desc)
        moreInfoButton = itemView.findViewById(R.id.more_info)

    }

    public fun bindDataToView(discount: Museum){
        museumDesc?.text = discount.Layout
        moreInfoButton?.setOnClickListener()
        {
            val controller = findNavController(itemView)
            controller.navigate(R.id.nav_slideshow)

        }
    }
}
