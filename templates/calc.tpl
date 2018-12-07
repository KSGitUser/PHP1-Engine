<form action="" >
    <label for="">Введите первую переменную:<input type="text" name=calcVar1></label>
    <select name="operation" id="">
        <option value="+">addition</option>
        <option value="-">substraction</option>
        <option value="*">multiplication</option>
        <option value="/">division</option>
    </select>
    <label for="">Введите вторую переменную:<input type="text" name=calcVar2></label>
    <input type="submit" value="=">
</form>


<p>{{RESULT}}</p>

<br>
<a href="{{HOMEHREF}}">Домой</a>