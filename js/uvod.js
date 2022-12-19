
document.querySelectorAll(".item").forEach(item => 
    item.addEventListener("click", () => window.location.href = "pokrm?id="+item.getAttribute("itemid"))
  );