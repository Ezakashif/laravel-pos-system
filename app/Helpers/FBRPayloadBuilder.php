<?php

namespace App\Helpers;

use App\Models\Transaction;

class FBRPayloadBuilder
{
    public static function build(Transaction $invoice, string $bposid)
    {
        return [
            'bposid' => $bposid,
            'invoiceType' => 2,
            'invoiceDate' => now()->toIso8601String(),
            'ntN_CNIC' => '',
            'buyerSellerName' => $invoice->contact->name ?? 'Cash Customer',
            'destinationAddress' => $invoice->location->name ?? 'N/A',
            'saleType' => 'T1000017',
            'totalSalesTaxApplicable' => $invoice->tax_amount ?? 0,
            'totalRetailPrice' => $invoice->final_total,
            'Items' => $invoice->sell_lines->map(function ($line) {
                return [
                    'hsCode' => $line->product->hs_code ?? '',
                    'productCode' => $line->product->sku,
                    'productDescription' => $line->product->name,
                    'rate' => $line->unit_price,
                    'uoM' => 'U1000003',
                    'quantity' => $line->quantity,
                    'valueSalesExcludingST' => $line->unit_price * $line->quantity,
                    'salesTaxApplicable' => 0,
                    'retailPrice' => $line->unit_price * $line->quantity,
                    'totalValues' => $line->unit_price * $line->quantity,
                ];
            })->toArray()
        ];
    }
}
