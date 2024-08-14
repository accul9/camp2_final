<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <button
        class="flex w-[210px] justify-center mr-10 px-8 py-2 my-10 text-lg text-white bg-green-500 border-0 rounded focus:outline-none hover:bg-green-600">カートに追加
    </button>
    <input type="hidden" name="redirect" value="{{ route('cart.add') }}">
</form>
