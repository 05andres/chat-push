<form action="{{ route('inserta') }}" method="post">
    {{ csrf_field() }}
    <div>
        <label for="msg">Message:</label>
        <textarea name="msg" id="msg"></textarea>
    </div>

    <div class="button">
        <button type="submit">Send your message</button>
    </div>
</form>
