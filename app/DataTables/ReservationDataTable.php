<?php

namespace App\DataTables;

use App\Models\Reservation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReservationDataTable extends DataTable
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
            ->addColumn('show', 'components.reservationsBtn.show')
            ->addColumn('edit', 'components.reservationsBtn.edit')
            ->addColumn('delete', 'components.reservationsBtn.delete')

            ->editColumn('check_in', function ($user) {
                return $user->updated_at->format('Y/m/d');
            })
            ->editColumn('check_out', function ($user) {
                return $user->updated_at->format('Y/m/d');
            })

            ->editColumn('room', function ($reservation) {
                return $reservation->room->number;
            })
            ->editColumn('confirmed_by', function ($user) {
                return $user->confirmed->name??"";
            })
            ->rawColumns([
                'edit',
                'show',
                'delete',
             ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReservationDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reservation $model)
    {
        $model->all();
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
                    ->setTableId('reservation-table')
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
            Column::make('id'),
            Column::make('check_in'),
            Column::make('check_out'),
            Column::make('reservation_price'),
            Column::make('accompanies'),
            Column::make('room_number'),
            Column::make('confirmed_by'),

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
        return 'Reservation_' . date('YmdHis');
    }
}
