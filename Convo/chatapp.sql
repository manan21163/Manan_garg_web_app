

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `messages` (
  `msgID` int(11) NOT NULL,
  `inmsgID` int(255) NOT NULL,
  `outmsgID` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `uniqueID` int(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE `messages`
  ADD PRIMARY KEY (`msgID`);

-- Indexes for table `users`

ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);


-- AUTO_INCREMENT for dumped tables


-- AUTO_INCREMENT for table `messages`

ALTER TABLE `messages`
  MODIFY `msgID` int(11) NOT NULL AUTO_INCREMENT;


-- AUTO_INCREMENT for table `users`
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


