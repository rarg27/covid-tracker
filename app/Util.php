<?php


namespace App;


class Util
{
    /**
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @return array $data
     */
    public static function cleanPaginate($paginator) {
        $data = array();
        $data['list'] = collect($paginator->items())->flatten();
        $data['from'] = $paginator->firstItem() ?? 0;
        $data['current_page'] = $paginator->currentPage();
        $data['per_page'] = $paginator->perPage();
        $data['to'] = $paginator->lastItem() ?? 0;
        $data['total'] = $paginator->total();
        return $data;
    }
}