<form method="post" action="{{route('rooms.destroy', [ 'room' => $number ])}}">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure to delete room?')" title="delete" class="btn btn-danger text-white btn-sm">
        <i class="fa fa-user-times"></i>
    </button>
</form>
