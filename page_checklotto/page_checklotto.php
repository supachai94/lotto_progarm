<div class="card w-50 mx-auto">
  <h4 class="card-header text-center bg-light">ตรวจผลรางวัล</h4>
  <div class="card-body">
    <hr>
    <form action="main.php?page=results_lotto" method="post">
      <div class="form-group mb-3">
        <label for="two-lower" class="form-label">สองตัวล่าง</label>
        <input type="number" id="two-lower" maxlength="2" class="form-control" required autofocus name="two-lower" onkeydown="if(event.keyCode==13) document.getElementById('three-upper').focus()">
      </div>
      <div class="form-group mb-3">
        <label for="three-upper" class="form-label">สามตัวบน</label>
        <input type="number" id="three-upper" maxlength="3" class="form-control" required name="three-upper" onkeydown="if(event.keyCode==13) document.getElementById('three-lower-1').focus()">
      </div>
      <div class="form-group mb-3">
        <label for="three-lower-1" class="form-label">สามตัวล่าง1</label>
        <input type="number" id="three-lower-1" maxlength="3" class="form-control" required name="three-lower-1" onkeydown="if(event.keyCode==13) document.getElementById('three-lower-2').focus()">
      </div>
      <div class="form-group mb-3">
        <label for="three-lower-2" class="form-label">สามตัวล่าง2</label>
        <input type="number" id="three-lower-2" maxlength="3" class="form-control" required name="three-lower-2" onkeydown="if(event.keyCode==13) document.getElementById('three-lower-3').focus()">
      </div>
      <div class="form-group mb-3">
        <label for="three-lower-3" class="form-label">สามตัวล่าง3</label>
        <input type="number" id="three-lower-3" maxlength="3" class="form-control" required name="three-lower-3" onkeydown="if(event.keyCode==13) document.getElementById('three-lower-4').focus()">
      </div>
      <div class="form-group mb-3">
        <label for="three-lower-4" class="form-label">สามตัวล่าง4</label>
        <input type="number" id="three-lower-4" maxlength="3" class="form-control" required name="three-lower-4" onkeydown="if(event.keyCode==13) document.getElementById('submit-button').focus()">
      </div>
      <div class="form-group text-center">
        <button id="submit-button" type="submit" class="btn btn-primary">ยืนยัน</button>
      </div>
    </form> 
  </div>
</div>
<script>
const inputs = document.querySelectorAll('input[type="number"]');
inputs.forEach((input, index) => {
  input.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      event.preventDefault();
      inputs[index + 1].focus();
    }
  });
});
</script>
  </div>
</div>