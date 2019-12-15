-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 07:47 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keamanan`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_file`
--

CREATE TABLE `table_file` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `file_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_file`
--

INSERT INTO `table_file` (`file_id`, `file_name`, `file_date`, `owner_id`, `user_id`) VALUES
(20, 'photo-1540189549336-e6e99c3679fe.jpg', '2019-09-05 09:15:47', 1, 19),
(24, 'pasar_baru_jadi.jpg', '2019-09-08 16:42:28', 19, 21),
(25, 'Presentation1.pptx', '2019-10-01 04:00:10', 19, 20),
(26, 'Ulva.pptx', '2019-10-01 04:14:21', 19, 21),
(28, 'Orin.xlsx', '2019-10-08 23:57:49', 19, 19);

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_phone` varchar(200) NOT NULL,
  `user_birthplace` varchar(200) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_sex` enum('Laki-Laki','Perempuan','','') NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_level` varchar(100) NOT NULL,
  `user_address` text NOT NULL,
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_publickey` text NOT NULL,
  `user_privatekey` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`user_id`, `user_email`, `user_name`, `user_phone`, `user_birthplace`, `user_birthdate`, `user_sex`, `user_password`, `user_level`, `user_address`, `user_create`, `user_lastlogin`, `user_publickey`, `user_privatekey`) VALUES
(1, 'admin@keamanan.com', 'admin', '#', '#', '0000-00-00', '', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '#', '2019-02-27 12:24:37', '2019-02-27 12:24:37', '', ''),
(19, 'ulfa@user.com', 'ulfa', '', 'Kendari', '0000-00-00', 'Perempuan', '95c946bf622ef93b0a211cd0fd028dfdfcf7e39e', 'user', 'Jln. Bunga Sakura', '2019-07-22 04:28:29', '2019-07-22 04:28:29', '-----BEGIN PUBLIC KEY-----\r\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA8BEpRLdJdSTHtw8Q+0ZD\r\nl77ZpL8IoyAb4M2BvwQubLET6KQg+6DWY5ksfSjQPu71PsXvvl4Oswsn7oOTXUf+\r\nQSK8Y2rXXE/ejOg055YN41DuyN/v0sWB4ZzAyF6VGVV3AvA4wYeBNxtdXwOwbOFy\r\na32JfdQdImvNkQ9G6ktlPh47e4x6F0md1qpPCFqAoP14LGJwe0O44efwM4yGaVA4\r\ntl4xppd1JQ3FErOTAnpnGY39JRRo4ZeJN1M0RhCeeApwoPGvopzrIN5dOhfDY+Dx\r\nyxJpDyiqJ0Ewbwmuc2KMmcwhMls6aLuA+0oPYjJbtZU12FsP1SjgxMA8A2AfXf6V\r\nKQIDAQAB\r\n-----END PUBLIC KEY-----', '-----BEGIN RSA PRIVATE KEY-----\r\nMIIEowIBAAKCAQEA8BEpRLdJdSTHtw8Q+0ZDl77ZpL8IoyAb4M2BvwQubLET6KQg\r\n+6DWY5ksfSjQPu71PsXvvl4Oswsn7oOTXUf+QSK8Y2rXXE/ejOg055YN41DuyN/v\r\n0sWB4ZzAyF6VGVV3AvA4wYeBNxtdXwOwbOFya32JfdQdImvNkQ9G6ktlPh47e4x6\r\nF0md1qpPCFqAoP14LGJwe0O44efwM4yGaVA4tl4xppd1JQ3FErOTAnpnGY39JRRo\r\n4ZeJN1M0RhCeeApwoPGvopzrIN5dOhfDY+DxyxJpDyiqJ0Ewbwmuc2KMmcwhMls6\r\naLuA+0oPYjJbtZU12FsP1SjgxMA8A2AfXf6VKQIDAQABAoIBAFE4rSq3jF3a1Msl\r\niMxK6IGFq6MmkuiF64iyXuxeoMpbWu4B4brgnshRwZCS52nzdPwJAeT5c6W154u1\r\n7nzH58jn1K8aLcTorNYllgioZwh6kF9cDIrWEexgGYVxIqbQmJRg7ALmMpyPYJbN\r\n67nayNh/P65Xvoevy3wBnC+W1Kkf75LA80knFqF7CqTzLe87/dzzCfe+EwXxqJb9\r\naFev0RxvIXnTrXDdS7I3Bo0lxyCgqDyOs/Z4WTh9Q1nE+D0uSVzcrM8BDgWBpVG5\r\nmu5DyBb4NBe6v5SxEHX75n0OH5SBql+EqbDnlHiWA+VTO2i9cyo/UJ9oWqQ4dHzL\r\n3+zqRoUCgYEA/3vMSDJNdKUlRTlnIBTLx5n/VDk7S3t9onosa1BqtxVS1adjUvcv\r\nQWCQ6T6aC1CYSeSzxOq8t/M08kdJoAJgjP1ZW+hqcB9GRwYZR7kKYhl/R6LMTg73\r\n1l74Ar3hQAAc/u/mNPKsHDeBw/L54ilF7kRAqIYlX7n8xvvjX9w2lp8CgYEA8I1i\r\nxIWmHT+tp3mPyU6xEifbdl+oi0egexc6up8Q1tgUTueaTBVWgEi0VhqaWsOpr4r5\r\nYeYEiQEUOf5ndz9nqFPlP1pkwtwBa0RASQeq+QDyeSLCdCOj0jeM+8okORezgtAn\r\n0Ex+MTBUCWbBl9UbLO9RtVY63VG1vo9i1NtuJzcCgYBHuJtKkUSJQGtMGadHrE7g\r\nw+yX2lE5CXvlhuK9ZZ/vsb7FV+5cNiQ/+Dn2IKriDkgSRm/pEfTUtyPf9/9FOiWc\r\nrurNEFwBCeaSvbWPGvU9QOcoVx1/tFgDCDobmu6HJwD82KAJsS575WE6fxWDVg7Z\r\nqrN0G+SWEQJTYhccrBdvBQKBgGrAlABav2ljhRE5pVHVFkfUYFScBxQoaVO27106\r\nkiKGKh0KMzNolMbBfSZpD+8PvhIlPp7vkTuruuoxuID3Jm1RLf97ghPnxslvtIe0\r\nW2+9t92CS4F2/5CfDnX/MywTFJsM/V43VBlINUMm0usqq7C5VC2BYwYs6Nb0kwub\r\nhbrpAoGBAP0sDGUfgvjgRz8ysZNFO7iL2DhuSnNAXdpAClhEg1bYSyO+RYmUJ0fW\r\nZYVD4OuPJMWays8d8Fn0fnWIzrtd0MGCWBGIgCdEQ9i28h9kok+G0LaZdSlna4rs\r\nGCgC/1tB1dTn5OOxDpcV2xdHHi1u2+ba/31VoU1eqj298j8lrdJG\r\n-----END RSA PRIVATE KEY-----'),
(20, 'cimi@user.com', 'cimi', '09', 'kendari', '0000-00-00', 'Perempuan', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user', '', '2019-07-22 04:28:57', '2019-07-22 04:28:57', '-----BEGIN PUBLIC KEY-----\r\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA9OiW7rjyxicfg4EE5OkX\r\n02A9TrKKUAE4NQUmBvzr+0B1unl16rdiEEvdFShQaXEudZyzRHn5lqPuYiemrnGp\r\nD/M7febImwMk/QTuyPHR47FJ4V0ETiIOdlFAGFxRlgIIwJ7c7l5vpM+HOo+cuRvH\r\n8S2z2AJhEXJsWjvX9uALeOuu1gWkrOVZWiIkHaoZoaj8y9LUtbbSdiU9lZrZELTp\r\n/bRmKNKvpYR2gXr9TBPs38Lns64nRMwRN2nmeb4wZb6Sm6mEpDdaeLjynk8yvIk5\r\nu8MJ9HZfylFT4WvL9idf2NieWjDHcb5syd6ExiB8x6mT+hD8S+X6AoSOP8LfsGmG\r\nvQIDAQAB\r\n-----END PUBLIC KEY-----', '-----BEGIN RSA PRIVATE KEY-----\r\nMIIEpAIBAAKCAQEA9OiW7rjyxicfg4EE5OkX02A9TrKKUAE4NQUmBvzr+0B1unl1\r\n6rdiEEvdFShQaXEudZyzRHn5lqPuYiemrnGpD/M7febImwMk/QTuyPHR47FJ4V0E\r\nTiIOdlFAGFxRlgIIwJ7c7l5vpM+HOo+cuRvH8S2z2AJhEXJsWjvX9uALeOuu1gWk\r\nrOVZWiIkHaoZoaj8y9LUtbbSdiU9lZrZELTp/bRmKNKvpYR2gXr9TBPs38Lns64n\r\nRMwRN2nmeb4wZb6Sm6mEpDdaeLjynk8yvIk5u8MJ9HZfylFT4WvL9idf2NieWjDH\r\ncb5syd6ExiB8x6mT+hD8S+X6AoSOP8LfsGmGvQIDAQABAoIBAQCJgT2c8wJ79uNe\r\ntkXFMIpMB7DkSqIVoVmpiyZ6re7gtqRi+mcWTbglZjLO+j+LtBxdtImCXOmhhpEF\r\nUzXmo7JEXlB8s+LWBcHyvZ5D/GHX8WaFve/43m44SA4wn0S/cIzxeUCaJTOR2WMX\r\noiJgXBS6eOqM0WkmnpPvZcIvvkMytCfRFaNQWVLKj80o0hYg5OJvFhKRJ/pdPEBU\r\npuuJkidDAaUzSo7xVf6rblS/9mtEDvDigJ+I+4otzz+GowVhwnJg/4AEoQcIJ0Us\r\ngnVFEQebfme6cj+4lcC5fvZ+63HPjnzL+3H87tIbdg63T/ZKKLsfuzpGh2rMQ1i2\r\nNPBFxrKBAoGBAP8eTk39rg8ku39ASeJFLX18ZhoQnuddrbt44uUCX/llramgj93e\r\nyC1lFIqcmygtNA2k3wgjrtmYPDxJSWV58pqF/W/e6bIPOyL4+SL2/rv5NWbWvwy2\r\n1v8LjCFi4scqir/h8CGV/p0HzWPzCR4DTFDuhrF9YUmuaP+8rh/tJDtZAoGBAPXB\r\nQF3LfGVCYQ1i9fjWGj0+gEgMy3mgulCnUBDiLt0iG6maGeUlZ1LB+fgGzidHX2ym\r\nzRqN4HG/VsJU80adtZ8QLUG93Z7GZZcunqfHDjrFi3jPVehU6/LTmAjDgpg2+Irh\r\nuSJc+2Z+FEkckcBgdvBx71qEl6i0ocUL2YLv8Y4FAoGAWIZWm598R4ryeMyBFr/0\r\ncge5ki/UQ+pwv43KBbdWQD81DJhHc7C7e20IvLRs7nsJBfcA4V0obh7yP+UaT9kK\r\nAu6dq7UJGJ1KYu9L3AMjD20BR8cakjnbzrJeFLOwh3XOoZiv76eRq0Gq1pTdxAlW\r\n8PpjyLD+Ekgv7RW2wiNSoDkCgYBYC/y7ngPbY4TR/vqRRGPyPUpIhg0Abo1SCB+v\r\nbNnNcELo6MUOS/BQvh6Itid1+yQ9ESW6tcoL9rlmtnjSe/5uFqWgQB3+nKYZHCLL\r\niY2XkN7/UYk9y+8c+KInwaQwVMGHQIfLv/RyLAmoiAvQGL+ENc3DaG3Ni6nJpw0u\r\n1Dh+4QKBgQDiRPAkVK6AwmFToYL+G1s7zIq5codEpnTCQbGZqG33TCNIPwpO9Pye\r\n1fud6F5nmEflUSFDYXWBVYpN8+MVhDjdsy+LkeoILerzkIt6T1tcueT0r6/dI/l6\r\nCek/ZZn8HZWC0uPfb3UcdOn/yXHdKSuzkoqg9tUq16B4iO2efx/s0w==\r\n-----END RSA PRIVATE KEY-----'),
(21, 'deni@user.com', 'denia', '-', 'Kendari', '1992-12-31', 'Perempuan', '95c946bf622ef93b0a211cd0fd028dfdfcf7e39e', 'user', '-', '2019-08-01 06:30:35', '2019-08-01 06:30:35', '-----BEGIN PUBLIC KEY-----\r\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnPsrt9p2Mx0ZieZLm7GS\r\nrdcYydGKxe/lrN/iIJQy3d9vCkkO0oZT61RD3aygNOQZjOGT7E3jBSpBPJ848dOr\r\n/YI86v5//y0NI65LjP6yEuNE+r3S1z247gucQ+7gYyZcBlzaOTPnsrGjCU7K3cAr\r\nqmmeRjrM7T8SdB9tjTv1vXAGiTRKWGQ5NgC1+MBj3k9pO9ek08N+APV+yFOMRE1O\r\n1P2MKMgLVfELUSaQoGxMIcdy1AVnWlsflFpj7XtyMdGPpGrUFd55QLhUcVp7/ynC\r\nIqufQUH21c7tyR9D7MnUm5+vAuy33id2mvrWxAHSvX2ZjeEWebLB72OFPNjkAM5V\r\nkQIDAQAB\r\n-----END PUBLIC KEY-----', '-----BEGIN RSA PRIVATE KEY-----\r\nMIIEpAIBAAKCAQEAnPsrt9p2Mx0ZieZLm7GSrdcYydGKxe/lrN/iIJQy3d9vCkkO\r\n0oZT61RD3aygNOQZjOGT7E3jBSpBPJ848dOr/YI86v5//y0NI65LjP6yEuNE+r3S\r\n1z247gucQ+7gYyZcBlzaOTPnsrGjCU7K3cArqmmeRjrM7T8SdB9tjTv1vXAGiTRK\r\nWGQ5NgC1+MBj3k9pO9ek08N+APV+yFOMRE1O1P2MKMgLVfELUSaQoGxMIcdy1AVn\r\nWlsflFpj7XtyMdGPpGrUFd55QLhUcVp7/ynCIqufQUH21c7tyR9D7MnUm5+vAuy3\r\n3id2mvrWxAHSvX2ZjeEWebLB72OFPNjkAM5VkQIDAQABAoIBABmpzjneUxiEF1q9\r\n9Xpci1g0I+9KfF9jmq6qYzNkRvSSxHpv+yZbo3iDbBzfTcmXyL2JWz90dDqx77xT\r\nY2HVcvacxgy80nwLB2zf36YLNV11Hh/HzKI3ivYPm9pXQQO0j7LSlzJm0+gYtkid\r\nQvkBo6HWZnOgxUO73e5x/NzsAn6XgkwYiF0AlPXZxPtyGVZO55jkiV8kD2LgQ+8/\r\nA8XwBtvDltbA6OzZ5iGYqheRvszer+rTboVuNCgPChZ34+9KIx4rbw0OOYH5BDOC\r\nxcCWeUNrq+ivVLMRhPRcevHU/ir8mYrK5IZyjufOne5fLvJsEosQEwiC7dPBy1UJ\r\n3yK0fkkCgYEAy7tLUO9U8hQ3XOlG8ZrfKNLcNz5NU1sjkPPUyORAnU1Z4rVfMolF\r\na249RKZrd4eDZbAa1LwZ3PgavBv9dvtFYY6I2q7Z1DQlrUs9n//034B0QC+wcfsF\r\n2Futuo7ofjxVuBkyMEHQ9D/P5T9ivKniJkuSSaCmIO23AoPAV+WHe9MCgYEAxUFk\r\nyCbyRX8xyty+3Q9LyqpaVB7dkS2kRa0MJLJMIwf8rSuK4SsIKpQ7vQmJyCm8yur3\r\n+A0nRf88l/bpHLtldkklX7RndOwESdquGsH8HeSqv1pR4VCT2O5LFXk3Z0ol97Ev\r\nYzZI57SjYBNimlzv9srGgbYRyC0fRXBhtNsbPosCgYEAuW8hT2p3s9uIxK2joBcp\r\n1ZuPS00OzrceuTnmTG/NDCAylzIkkvf00qLFa23aVTJn+699zHHlTIYat2r2mkx8\r\nyx4UHI+Xvxkzzfa1AaPUO3ZM2XtOq4Aiwto3V53pqbS7BNUSJHBTg21tiajW8wfh\r\nyp9waEmrzD7yG3zWHmrRlXcCgYBnSp0JqktHVRmvzvQrMe1QTPBMCHWhpjLVQY6Q\r\nUMVJus73p0tsKWp3UXQOw0XhCOoRoAUFYW3lW4hRUzwyjXbN//OQMBnUwhpkyhxN\r\narMovCslVJh30gf5mp66ueTnM466K5BS9YQrwQ2kK8KAbpZBt2FHXx3koqwzYmvn\r\nlqynjQKBgQC85LxWpYcOKhGMjEq0OSwSa7+9ZApFipBu1Uj/x4EDcxwxoGNMeiSK\r\nLfMgdAJY0oiXU+uXPD2kn4mkj1u7aLrULyfZKrSPuIlNJHWE39vNJboRCboPD3dM\r\n2LMRna7oV2ae0ZNGuSrLZ5GnSbLmdOvYVXVtEvqyxGsYaAqhvwZnUA==\r\n-----END RSA PRIVATE KEY-----');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_file`
--
ALTER TABLE `table_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_file`
--
ALTER TABLE `table_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
