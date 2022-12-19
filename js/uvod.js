
/**
 * Při kliknutí na každý objekt se třídou .item, přesměruje na pokrm s id z atributu pokrmid daného objektu
 */
document.querySelectorAll(".item").forEach(item => 
    item.addEventListener("click", () => window.location.href = "pokrm?id="+item.getAttribute("itemid"))
  );