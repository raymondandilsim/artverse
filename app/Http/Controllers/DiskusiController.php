<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diskusi;
use App\Models\Lukisan;

class DiskusiController extends Controller
{
    public function DiskusiPage($id){
        $lukisan = Lukisan::findOrFail($id);
        $diskusis = Diskusi::whereNull('balasan_id')
                    ->where('lukisan_id', '=', $id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(7);

        foreach ($diskusis as $diskusi) {
            $diskusi -> setAttribute('reply',Diskusi::whereNotNull('balasan_id')->where('balasan_id','=',$diskusi->id)->orderBy('created_at')->get());
            $diskusi -> makeVisible(['reply']);
            $replies = Diskusi::where("balasan_id", "=", $diskusi->id)->get();
            $diskusi->replies = $replies;
        }
        return view('forum-diskusi', compact('lukisan','diskusis'));
    }

    public function unggahDiskusi(Request $request){
        $request->validate([
            'text' => 'required|string|max:2000',
            'lukisan_id' => 'required'
        ],
        [
            'text.required'=>'Harus terdapat kalimat pada kolom diskusi ini',
            'text.max'=>'Maksimal kata adalah 2000 kata',
        ]);

        $diskusi = new Diskusi();
        $diskusi->user_id = auth()->user()->id;
        $diskusi->text = $request->text;
        $diskusi->lukisan_id = $request->lukisan_id;
        $diskusi->save();

        return redirect('/diskusiPage' . "/" . $request->lukisan_id)->with('status', 'Berhasil menambahkan diskusi');
    }

    public function replyDiskusi(Request $request, $balasan_id){
        $request->validate([
            'reply' => 'required|string|max:2000',
            'lukisan_id' => 'required'
        ],
        [
            'reply.required'=>'Harus terdapat kalimat pada kolom diskusi ini',
            'reply.max'=>'Maksimal kata adalah 2000 kata',
        ]);

        $diskusi = new Diskusi();
        $diskusi->user_id = auth()->user()->id;
        $diskusi->text = $request->reply;
        $diskusi->lukisan_id = $request->lukisan_id;
        $diskusi->balasan_id = $balasan_id;
        $diskusi->save();

        return redirect('/diskusiPage' . "/" . $request->lukisan_id)->with('status', 'Berhasil menambahkan balasan');
    }

}
