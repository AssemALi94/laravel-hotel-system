<?php

namespace App\DataTables;

use App\Models\floor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class floorDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('show', 'components.floorBtn.show')
            ->addColumn('edit', 'components.floorBtn.edit')
            ->addColumn('delete', 'components.floorBtn.delete')


            ->editColumn('created_by', function ($user) {
                return $user->creator->name;
            })
//            ->editColumn('created_at', function ($user) {
//                return $user->updated_at->format('Y/m/d');
//            })
//            ->editColumn('updated_at', function ($user) {
//                return $user->updated_at->format('Y/m/d');
//            })
            ->rawColumns([
                'show',
                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\floor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(floor $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('floor-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('number'),
            Column::make('no_of_rooms'),
            Column::make('created_by'),
//            Column::make('created_at'),
//            Column::make('updated_at'),
            Column::computed('show')
                ->width(40)
                ->addClass('text-center'),
            Column::computed('edit')
                ->width(40)
                ->addClass('text-center'),
            Column::computed('delete')
                ->width(40)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'floor_' . date('YmdHis');
    }
}
