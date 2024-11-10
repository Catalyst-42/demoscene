import matplotlib.pyplot as plt

from re import findall
from math import ceil
from datetime import datetime
from matplotlib.dates import DateFormatter

# Dump sql from format
# INSERT INTO near VALUES (id, 'text', 'date');
# INSERT INTO near VALUES (id, 'text', 'date');
# ...

comments = []

insertions = findall(
    r"INSERT INTO near VALUES (\(.+)\)",
    open("dump.sql", "r").read()
)

for insertion in insertions:
    comment_id, comment, date = findall(
        r"(\d+),(.+),'(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})'",
        insertion
    )[0]
    
    comments.append({
        "id": int(comment_id),
        "comment": comment,
        "date": datetime.strptime(date, "%Y-%m-%d %H:%M:%S"),
    })

# Get comment history
total_weeks = ceil((comments[-1]["date"] - comments[0]["date"]).days / 7)
comments_history = {
    "x": [],
    "y": [],
}

total = 0
for comment in comments:
    total += 1
    comments_history["x"].append(comment["date"])
    comments_history["y"].append(total)

print(f"Всего комментариев: {total:,}")
print(f"Последний id: {comments[-1]["id"]:,}")

# Plots
fig, axs = plt.subplot_mosaic(
    [["comments"], ["activity"]],
    figsize=(12.5, 7.5),
)

fig.canvas.manager.set_window_title("Статистика Demoscene")
ax = list(axs.items())

# Comments
ax[0][1].set_title("Число комментариев", loc="left")
ax[0][1].plot(
    comments_history["x"],
    comments_history["y"],
    color="tab:purple",
    linewidth=3
)
ax[0][1].xaxis.set_major_formatter(DateFormatter('%d.%m.%Y'))
ax[0][1].set_xlim(comments_history["x"][0], comments_history["x"][-1])
ax[0][1].set_ylim(0, total + 500)

# Activity
ax[1][1].set_title("Активность по неделям", loc="left")
ax[1][1].hist(
    comments_history["x"],
    bins=total_weeks,
    color="tab:purple"
)
ax[1][1].xaxis.set_major_formatter(DateFormatter('%d.%m.%Y'))
ax[1][1].set_xlim(comments_history["x"][0], comments_history["x"][-1])
ax[1][1].set_ylim([1, 10**4])
ax[1][1].set_yscale("log")

plt.tight_layout()
plt.show()
