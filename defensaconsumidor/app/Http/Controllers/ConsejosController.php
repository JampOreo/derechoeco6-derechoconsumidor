<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsejosController extends Controller
{
    public function index()
    {
        // Datos estáticos por ahora (luego los puedes traer de BD o de un archivo)
        $texto = "La Dirección Provincial del Consumidor en Misiones se encuentra en Posadas y atiende casos de toda la provincia. La dirección es Av. Mitre 196, en la esquina con Pellegrini. Puedes contactarlos al teléfono (0376) 444-7533 para atención al público, y también consultar si hay un número de WhatsApp activo y actualizado. El horario de atención es de lunes a viernes, generalmente de 7:00 a 13:00 hs, aunque es recomendable verificar posibles cambios. No tienen una página web propia, pero puedes encontrar información en el sitio del Gobierno de Misiones.";

        return view('consejos.index', compact('texto'));
    }
}