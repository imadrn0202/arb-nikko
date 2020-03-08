<?php 

namespace App\Repositories\Contract;
use Illuminate\Http\Request;

interface RepositoryInterface {
    public function get();
    public function insert($request);
    public function update($request);
    public function delete($request);
}
?>