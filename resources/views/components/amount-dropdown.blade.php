<p class="my-5 text-xl text-gray-500">数量：
    <select name="quantity" id="quantity" class="w-[100px] px-2 py-1 mt-2 border border-gray-300 rounded">
        @for ($i = 1; $i <= 10; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
</p>
