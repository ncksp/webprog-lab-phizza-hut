<div class="card-footer">
    <div class="d-flex justify-content-between">
        <form action="{{route('pizza.destroy', $item->id)}}" class="d-flex flex-row-reverse bd-highlight" method="post"
            class="mr-5">
            @csrf
            {{ method_field('DELETE') }}
            <input type="hidden" name="id" required value="{{$item->id}}">
            <button type="submit" onclick="return confirm('Remove this item?')"
                class="btn btn-danger btn-sm">Delete</button>
        </form>

        <a href="{{route('pizza.edit', $item->id)}}" class="btn btn-sm btn-secondary">Update</a>
    </div>
</div>