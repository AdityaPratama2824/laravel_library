let startBorrow = document.getElementById("start_borrow")

startBorrow.addEventListener("change", function(){
    let date = new Date(`${this.value}`);

    let getDateStart = date.getDate();

    let endDate = date.setDate(getDateStart + 3);

    let endBorrow = document.getElementById("end_borrow");
    
    let endBorrowValue = `${new Date(endDate).getFullYear()}-${new Date(endDate).getMonth() + 1 < 10 ? `0${new Date(endDate).getMonth() +1}` : new Date(endDate).getMonth() + 1}-${new Date(endDate).getDate() < 10 ? `0${new Date(endDate).getDate()}` : new Date(endDate).getDate()}`

    endBorrow.value = endBorrowValue
})