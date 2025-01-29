<?php
namespace App\Http\Controllers;  
  
use App\Models\User;  
use Illuminate\Http\Request;  
  
class UserController extends Controller  
{  
    public function index()  
    {  
        // Mengambil semua pengguna dari database  
        $users = User::all();  
          
        // Mengembalikan view dengan data pengguna  
        return view('admin.users.index', compact('users'));  
    }  

    public function destroy($id)  
    {  
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID  
        $user->delete(); // Menghapus pengguna  
  
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.'); // Redirect dengan pesan sukses  
    }  
}  
?>