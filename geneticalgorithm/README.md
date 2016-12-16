# README: Genetic Algorithms Final Exam
#### Justin Jamison
#### IS 537
#### 12/15/16

In the 8 hours that were allotted to us, I didn't get as far on the project as I'd hoped, but I did find it to be a fun problem to tackle. I'll describe how far I got in this README file.

## Structure

I structured the program similarly to the way that was described in the Project Description - I created a Room class, a Course class, a Solution class, and a Course Assignment class. 

* The Main file iterates over the two CSV files and creates Room and Course objects for each room and class. 
* Each Room object has an array five days, and each day has an array of timeslots from 8 am to 4:30 pm.
* Each Course object has an array of days that corresponds to the days it can be scheduled.
* The Course Assignment class has a function called createAssignment, where the bulk of my work is contained. This function uses a $course object and an array of $rooms (created in the Main file) to remove timeslots from room objects. It does this in a way that meets the criteria of the assignment where required, while using a random function for those assignments that are supposed to be made randomly (and improved upon in the genetic algorithm).

## Output

When the program is run, it outputs a list of each Class Section with some output lines about the classroom scheduling process:

* Class name
* Hours
* Section
* num_slots: The number of slots it takes to accomodate the course.
* Random Room: The room that was randomly chosen based on whether it can accomodate the number of students in the course section.
* Valid Days: Lists the days that the course must meet.
* Starting timeslot_key: The first timeslot that is randomly attempted. If the timeslot does not work, other timeslots will be attempted.
* Timeslot_key Reassigned: Gives the new timeslot_key that was assigned after the previously-attempted one didn't work.
* Final Assigned Timeslot: The final timeslot that was settled on.

If the function cannot find a set of timeslots that accomodate the course's needs after 25 attempts, it will give up and refuse to schedule the course.

The program (as currently constituted) will output the above, as well as the arrays of remaining timslots for each room, to the console. It will also output the above list to the output.txt file. However, it does not output the arrays to this file.