function addPreviousNextButtonsFunctionality() {
	nextPageButton.addEventListener("click", (event) => {
		event.preventDefault();
		if (currentPageNumber < currentPageCount) {
			currentPageNumber = currentPageNumber + 1;
		}
		if (currentPageNumber === currentPageCount) {
			nextPageButton.classList.add("hidden");
			previousPageButton.classList.remove("hidden");
		} else {
			nextPageButton.classList.remove("hidden");
			previousPageButton.classList.remove("hidden");
		}
		displayArticlesOnPage(currentPageNumber);
	});
	previousPageButton.addEventListener("click", (event) => {
		event.preventDefault();
		if (currentPageNumber <= currentPageCount) {
			currentPageNumber = currentPageNumber - 1;
		}
		if (currentPageNumber === 1) {
			previousPageButton.classList.add("hidden");
			nextPageButton.classList.remove("hidden");
		} else {
			nextPageButton.classList.remove("hidden");
			previousPageButton.classList.remove("hidden");
		}
		displayArticlesOnPage(currentPageNumber);
	});
}

function updatePagingButtonsVisibility() {
	// Check if previous and next button should be visible
	if (currentPageCount === 1) {
		nextPageButton.classList.add("hidden");
		previousPageButton.classList.add("hidden");
	}
	if (currentPageNumber === 1 && currentPageCount > 1) {
		previousPageButton.classList.add("hidden");
	}
	if (currentPageNumber === currentPageCount && currentPageCount > 1) {
		nextPageButton.classList.add("hidden");
	}
	if (1 < currentPageNumber && currentPageNumber < currentPageCount) {
		nextPageButton.classList.remove("hidden");
		previousPageButton.classList.remove("hidden");
	}
}
