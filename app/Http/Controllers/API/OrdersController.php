<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\CurrencyRate;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrdersController extends Controller
{
    /**
     * Листинг заказов
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $orders = Order::paginate(15);
        return OrderResource::collection($orders);
    }

    /**
     * Создание заказа
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    /**
     * Просмотр заказа
     * @param  int  $id
     * @return OrderResource
     */
    public function show(int $id): OrderResource
    {
        $order = Order::findOrFail($id);
        return new OrderResource($order);
    }

    /**
     * Обновление параметров заказа
     * @param  OrderRequest  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(OrderRequest $request, int $id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return response()->json($order);
    }

    /**
     * Удаление заказа
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(null, 204);
    }
}
