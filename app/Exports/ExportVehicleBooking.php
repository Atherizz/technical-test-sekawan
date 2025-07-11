<?php 
namespace App\Exports;

use App\Models\VehicleBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportVehicleBooking implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return VehicleBooking::with(['vehicle', 'user', 'driver'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama User',
            'Nama Driver',
            'Kendaraan',
            'Waktu Keberangkatan',
            'Tujuan',
            'Status',
            'Created At',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->user->name ?? '-',
            $booking->driver->name ?? '-',
            $booking->vehicle
            ? $booking->vehicle->brand . ' (' . $booking->vehicle->license_plate . ')'
            : '-',
            $booking->departure_time,
            $booking->purpose,
            $booking->status ?? 'pending',
            $booking->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
