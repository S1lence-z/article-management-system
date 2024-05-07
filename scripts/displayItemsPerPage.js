// Nodes
const wholeListNode = document.getElementById("article-list");
const articleCount = wholeListNode.childElementCount;
const allArticles = getChildNodes(wholeListNode);
// Buttons
const allDeleteButtons = document.getElementsByName("delete-article-button");
const previousPageButton = document.getElementById("previous-button");
const nextPageButton = document.getElementById("next-button");
// Constants
const articlesPerPage = 10;
// Variables
let currentPageCount = Math.ceil(articleCount / articlesPerPage);
let currentPageNumber = 1;

// Functions
function getChildNodes(ulNode) {
	if (ulNode) {
		const articles = Array.from(ulNode.children);
		return articles;
	}
	return [];
}

function getStartingEndingIndex(currentPageNumber, perPage) {
	const startIndex = (currentPageNumber - 1) * perPage;
	let endIndex;
	// The last (or first) page has less than 10 articles
	if (currentPageNumber === currentPageCount) {
		endIndex = allArticles.length;
	} else {
		endIndex = startIndex + perPage;
	}
	return [startIndex, endIndex];
}

function displayArticlesOnPage(pageNumber) {
	const indexes = getStartingEndingIndex(pageNumber, articlesPerPage);
	const startingIndex = indexes[0];
	const endingIndex = indexes[1];
	const wantedArticles = allArticles.slice(startingIndex, endingIndex);

	// Clear the current list on the page
	while (wholeListNode && wholeListNode.firstChild) {
		wholeListNode.removeChild(wholeListNode.firstChild);
	}

	// Put desired number of elements to the list
	for (let i = 0; i < wantedArticles.length; i++) {
		const articleChild = wantedArticles[i];
		wholeListNode.appendChild(articleChild);
	}
}

function updateApp() {
	// Kind of a mainloop
	// buttons
	addDeleteFunctionality();
	addPreviousNextButtonsFunctionality();
	// display
	displayArticlesOnPage(currentPageNumber);
	updatePagingButtonsVisibility();
	displayPageCount();
}

document.addEventListener("DOMContentLoaded", () => updateApp());
