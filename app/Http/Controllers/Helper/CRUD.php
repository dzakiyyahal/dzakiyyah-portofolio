<?php
namespace App\Http\Controllers\Helper;

use Illuminate\Support\Facades\Validator;

class CRUD
{
    public function getAllData($model, $relation = null, $orderBy = 'created_at', $sekolahId = null)
    {
        $data = null;
        $sort = 'DESC';

        $user = auth()->user();
        $userId = $user->id;
        $role = $user->role->name;

        if ($orderBy != 'created_at') {
            $sort = 'ASC';
        }

        if ($relation) {
            $data = $model::with($relation)->orderBy($orderBy, $sort)->get();
        } else {
            $data = $model::all();
        }

        if (!$data->isEmpty()) {
            return response()->json($data, 200);
        } else {
            return response()->json(
                [
                    'message' => 'Tidak ada data',
                ],
                404
            );
        }
    }

    public function getDataById($model, $id, $relation = null)
    {
        $data = null;

        $user = auth()->user();
        $userId = $user->id;
        $role = $user->role->name;

        if ($role == 'guru') {
            if ($relation) {
                $dataRaw = $model::with($relation)->find($id);
                $isTeacher = $dataRaw->user->contains('id', $userId);

                if (!$isTeacher) {
                    return response()->json(
                        [
                            'message' => 'Anda tidak mengampu mapel tersebut',
                        ],
                        402,
                    );
                }

                $data = $dataRaw;
            } else {
                $dataRaw = $model::find($id);
                $isTeacher = $dataRaw->user->contains('id', $userId);

                if (!$isTeacher) {
                    return response()->json(
                        [
                            'message' => 'Anda tidak mengampu mapel tersebut',
                        ],
                        402,
                    );
                }

                $data = $dataRaw;
            }
        } else {
            if ($relation) {
                $data = $model::with($relation)->find($id);
            } else {
                $data = $model::find($id);
            }
        }

        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(
                [
                    'message' => 'Data tidak ditemukan',
                ],
                404,
            );
        }
    }

    public function createData($model, $request, $rules, $sekolahId = null)
    {
        $customMessages = [
            'exists' => 'Data with :attribute does not exist',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'Form validation failed',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        if ($sekolahId) {
            $datas = $request->all();
            array_push($datas, [
                'sekolah_id' => $sekolahId
            ]);

            $data = $model::create($datas);
        } else {
            $data = $model::create($request->all());
        }

        return response()->json(
            [
                'message' => 'Data berhasil ditambahkan',
                'data' => $data,
            ],
            201,
        );
    }

    public function updateData($model, $request, $rules, $id)
    {
        $data = $model::find($id);

        foreach ($rules as $key => $value) {
            if (strpos($value, 'unique') !== false) {
                $rules[$key] = $value . ',' . $id;
            }
        }

        if ($data) {
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'message' => 'Form validation failed',
                        'errors' => $validator->errors(),
                    ],
                    422,
                );
            }

            $data->update($request->all());

            return response()->json(
                [
                    'message' => 'Data berhasil diubah',
                    'data' => $data,
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'message' => 'Data tidak ditemukan',
                ],
                404,
            );
        }
    }

    public function deleteData($model, $id)
    {
        $data = $model::find($id);

        if ($data) {
            $data->delete();

            return response()->json(
                [
                    'message' => 'Data berhasil dihapus',
                ],
                201,
            );
        } else {
            return response()->json(
                [
                    'message' => 'Data tidak ditemukan',
                ],
                404,
            );
        }
    }
}