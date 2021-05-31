<?php

namespace App\DataTables;

use App\Models\Room;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoomDataTable extends DataTable
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
            ->addColumn('edit', 'components.roomsBtn.edit')
            ->addColumn('show', 'components.roomsBtn.show')
            ->addColumn('delete', 'components.roomsBtn.delete')


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
     * @param \App\Models\Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model)
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
                    ->setTableId('room-table')
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
            Column::make('floor_number'),
            Column::make('created_by'),
            Column::make('room_price'),
            Column::make('capacity'),
            Column::make('status'),
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
        return 'Room_' . date('YmdHis');
    }
}
