var rangeInput = document.getElementById("price_range");
var valueSpan = document.getElementById("range_value");

function updateRangeValue() {
  valueSpan.textContent = rangeInput.value + "€";
}
rangeInput.addEventListener("input", updateRangeValue);
updateRangeValue();
