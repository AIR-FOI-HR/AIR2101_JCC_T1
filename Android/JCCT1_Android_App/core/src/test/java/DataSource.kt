import android.content.Context

interface DataSource {
    fun loadData(dataSourceListener: DataSourceListener, context: Context)
}