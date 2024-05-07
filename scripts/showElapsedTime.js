const creationTimeElements = document.querySelectorAll("#creation-time");
const changeTimeElements = document.querySelectorAll("#change-time");
setInterval(updateTimes, 1000);
// Functions to get the relative time
function getCurrentTimeStamp() {
	const dateObject = new Date();
	const year = dateObject.getFullYear().toString();
	const month = (dateObject.getMonth() + 1).toString().padStart(2, "0");
	const day = dateObject.getDate().toString().padStart(2, "0");
	const hours = dateObject.getHours().toString().padStart(2, "0");
	const minutes = dateObject.getMinutes().toString().padStart(2, "0");
	const seconds = dateObject.getSeconds().toString().padStart(2, "0");
	return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

function getElapsedTime(start, end) {
	const dateStart = new Date(start.toString().replace(" ", "T"));
	const dateEnd = new Date(end.toString().replace(" ", "T"));

	let elapsedSeconds = dateEnd - dateStart;
	let days = Math.floor(elapsedSeconds / (1000 * 60 * 60 * 24));
	let hours = Math.floor((elapsedSeconds % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	let minutes = Math.floor((elapsedSeconds % (1000 * 60 * 60)) / (1000 * 60));
	let seconds = Math.floor((elapsedSeconds % (1000 * 60)) / 1000);
	if (days > 0) {
		return days <= 1 ? days.toString() + " day ago" : days.toString() + " days ago";
	}
	if (hours > 0) {
		return hours <= 1 ? hours.toString() + " hour ago" : hours.toString() + " hours ago";
	} else if (minutes > 0) {
		return minutes <= 1
			? minutes.toString() + " minute ago"
			: minutes.toString() + " minutes ago";
	}
	return seconds <= 1 ? seconds.toString() + " second ago" : seconds.toString() + " seconds ago";
}

function updateTimes() {
	let currentTimeStamp = getCurrentTimeStamp();

	for (let element of creationTimeElements) {
		const creationTimeStamp = element.dataset.creation;
		element.textContent = "Created: " + getElapsedTime(creationTimeStamp, currentTimeStamp);
	}

	for (let element2 of changeTimeElements) {
		const changedTimeStamp = element2.dataset.change;
		element2.textContent = "Edited: " + getElapsedTime(changedTimeStamp, currentTimeStamp);
	}
}
