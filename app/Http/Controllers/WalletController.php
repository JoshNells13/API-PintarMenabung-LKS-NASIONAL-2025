<?php

namespace App\Http\Controllers;

use App\Models\Currencies;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function AddWalet(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'currency_code' => 'required'
        ]);

        $Currency = Currencies::where('code', $request->currency_code)->first();

        if (!$Currency) {
            return response([
                'message' => 'Currency Not found'
            ], 404);
        }

        $Wallets = Wallet::create([
            'name' => $request->name,
            'user_id' => $request->user()->id,
            'currency_id' => $Currency->id
        ]);


        $Wallets->with('Currency');

        return response([
            'status' => 'success',
            'message' => 'Wallet added successful',
            'data' => [
                'name' => $Wallets->name,
                'user_id' => $Wallets->user_id,
                'updated_at' => $Wallets->updated_at,
                'created_at' => $Wallets->created_at,
                'id' => $Wallets->id,
                'currency_code' => $Wallets->Currency->name
            ]
        ], 200);
    }

    public function UpdateWalet(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);


        $Chekuser = Wallet::where('user_id', $request->user()->id)->first();

        if (!$Chekuser) {
            return response([
                'status' => 'error',
                'message' => 'Forbiden Access'
            ], 403);
        }

        $Wallets = Wallet::find($id);


        if (!$Wallets) {
            return response([
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }


        $Wallets->update([
            'name' => $request->name,
            'user' => $request->user()->id,
        ]);

        $Wallets->with('Currency');


        return response([
            'status' => 'success',
            'message' => 'Wallet Updated successful',
            'data' => [
                'name' => $Wallets->name,
                'user_id' => $Wallets->user_id,
                'updated_at' => $Wallets->updated_at,
                'created_at' => $Wallets->created_at,
                'id' => $Wallets->id,
                'currency_code' => $Wallets->Currency->name
            ]
        ], 200);
    }


    public function DeleteWallet(Request $request, $id)
    {
        $Wallets = Wallet::find($id);

        $CheckUser = Wallet::where('user_id', $request->user()->id);

        if (!$CheckUser) {
            return response([
                'status' => 'error',
                'message' => 'Forbiden Access'
            ], 403);
        }

        if (!$Wallets) {
            return response([
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }
    }


    public function GetAllWallets(Request $request)
    {
        $Wallets = Wallet::with('Currency')->where('user_id', $request->user()->id)->get();

        return response([
            'status' => 'success',
            'message' => 'Get All wallets successful',
            'data' => [
                'wallets' => $Wallets->map(function ($data) {
                    return [
                        'id' => $data->id,
                        'user_id' => $data->user_id,
                        'name' => $data->name,
                        'created_at' => $data->created_at,
                        'updated_at' => $data->updated_at,
                        'deleted_at' => $data->deleted_at,
                        'currency_code' => $data->Currency->name,
                    ];
                })

            ]
        ], 200);
    }

    public function GetDetailWallets(Request $request, $id)
    {
        // Ambil wallet milik user + eager load currency
        $wallet = Wallet::with('Currency')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();


        if (!$wallet) {
            return response([
                'status' => 'error',
                'message' => 'Not found or forbidden access'
            ], 404);
        }

        return response([
            'status' => 'success',
            'message' => 'Get detail wallet successful',
            'data' => [
                'wallets' => [
                    'id'          => $wallet->id,
                    'user_id'     => $wallet->user_id,
                    'name'        => $wallet->name,
                    'created_at'  => $wallet->created_at,
                    'updated_at'  => $wallet->updated_at,
                    'deleted_at'  => $wallet->deleted_at,
                    'currency'    => $wallet->Currency->name,
                ]
            ]
        ], 200);
    }
}
