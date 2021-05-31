<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

//        $query = DB::table('users')->where('role','=','admin');
        return datatables()

            ->eloquent($query)
            ->addColumn('show', 'components.user.show')
            ->addColumn('edit', 'components.user.edit')
            ->addColumn('delete', 'components.user.delete')

            ->editColumn('created_at', function ($user) {
                return $user->updated_at->format('Y/m/d');
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('Y/m/d');
            })
            ->rawColumns([
                'show',
                'edit',
                'delete',
             ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if ($this->role){
            return $model->newQuery()
                ->where('role','=',$this->role);
        }
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
                    ->setTableId('user-table')
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
            Column::make('name'),
            Column::make('role'),
            Column::make('country'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'User_' . date('YmdHis');
    }
}
