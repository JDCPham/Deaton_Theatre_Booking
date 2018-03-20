stalls = ["","A","B","C","D","E","F","G","H","I","J"]
dress = ["","A","B","C","D","E","F","G","H"]
eventid = input("Enter event id number")
print ("INSERT INTO `deatontheatre`.`tblSeat` (`seat_id`, `event_id`, `person_id`, `tier`, `row`, `number`, `childadult`) VALUES")
for i in range (1,11):
       for x in range (1,24):
         print("(NULL, '",eventid,"', '', 'Stalls', '",stalls[i],"', '",x,"', ''),")

for a in range (1,9):
       for b in range (1,24):
         print("(NULL, '",eventid,"', '', 'Dress Circle', '",dress[a],"', '",b,"', ''),")

